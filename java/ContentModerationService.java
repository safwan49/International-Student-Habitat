package com.ish.services;
import com.ish.models.Report;
import com.ish.repositories.ReportRepository;
import com.ish.repositories.ContentRepository;
// Handles content approve or remove from pending
// prevents double reports called from Admin\ReportController

public class ContentModerationService {
    private final ReportRepository reportRepository;
    private final ContentRepository contentRepository;
    public ContentModerationService(ReportRepository reportRepository,ContentRepository contentRepository) {
        this.reportRepository  = reportRepository;
        this.contentRepository = contentRepository;
    }
    /*Report filing. same content can't be reported twice by one*/
    public Report fileReport(long reporterId, String reportableType, long reportableId, String reason) {
        if (reason==null || reason.isBlank())  throw new IllegalArgumentException("A reason must be provided.");
        boolean alreadyReported = reportRepository.existsByReporterIdAndReportableTypeAndReportableId(reporterId, reportableType, reportableId);
        if (alreadyReported) throw new IllegalStateException("You have already reported this content.");
        Report report = new Report(reporterId, reportableType, reportableId, reason.trim());
        return reportRepository.save(report);
    }
    /*Admin approves content reported but not violating rules. Status goes pending to approved*/
    public void approveReport(long reportId) {
        Report report = getOrThrow(reportId);
        requirePending(report);
        report.setStatus("approved");
        reportRepository.save(report);
    }
    /*Admin removes content that violates rules,content status goes from pending to removed*/
    public void removeContent(long reportId) {
        Report report = getOrThrow(reportId);
        requirePending(report);
        //delete content record
        contentRepository.deleteByTypeAndId(report.getReportableType(), report.getReportableId());
        report.setStatus("removed");
        reportRepository.save(report);
    }
    //helper meths white,green,blue
    private Report getOrThrow(long reportId) { return reportRepository.findById(reportId).orElseThrow(() -> new IllegalArgumentException("Report not found: " + reportId));}
    private void requirePending(Report report) {
        if (!"pending".equals(report.getStatus())) throw new IllegalStateException("Report #" + report.getId() + " has already been actioned.");
    }
}
