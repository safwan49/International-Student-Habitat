package com.ish.services;
import com.ish.models.User;
import com.ish.repositories.UserRepository;
// Updates points for users.
// getTier meths maps points to the display label per spec requirements
// Called from ExperienceController and AnswerController

public class ReputationService {
    // Reward points for city exp and qn ans
    public static final int POINTS_EXPERIENCE = 3;
    public static final int POINTS_ANSWER = 1;
    // tierlists
    private static final int TIER_SEASONED_MIN = 7;
    private static final int TIER_ADVISOR_MIN = 16;
    private final UserRepository userRepository;
    public ReputationService(UserRepository userRepository) { this.userRepository = userRepository;}

    /*Awards points to a user after any experience or answer uploads*/
    public void award(long userId, int points) {
        if (points<=0) throw new IllegalArgumentException("Points awarded must be positive.");
        User user = userRepository.findById(userId).orElseThrow(() -> new IllegalArgumentException("User not found: " + userId));
        user.setReputationPoints(user.getReputationPoints() + points);
        userRepository.save(user);
    }

    //returns badge based on reputaion. less than 6 = New Contributor, 7–15  = knows ball, more than 15 = Someone stop him
    public static String getTier(int reputationPoints) {
        if (reputationPoints>= TIER_ADVISOR_MIN)  return "Trusted Advisor";
        if (reputationPoints>= TIER_SEASONED_MIN) return "Seasoned Vet";
        return "New Contributor";
    }
    /*Returns color key for frontend tier badge*/
    public static String getTierColour(int reputationPoints) {
        if (reputationPoints >= TIER_ADVISOR_MIN) return "green";
        if (reputationPoints >= TIER_SEASONED_MIN) return "blue";
        return "gray";
    }
}
