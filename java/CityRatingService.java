package com.ish.services;
import com.ish.models.CityRating;
import com.ish.repositories.CityRatingRepository;
import java.util.List;
import java.util.OptionalDouble;
// computes the average.Called from CityRatingController

public class CityRatingService {
    private final CityRatingRepository ratingRepository;
    public CityRatingService(CityRatingRepository ratingRepository) { this.ratingRepository = ratingRepository;}

    //insert or update an user's city rating from 1-5, overwrites an existing from same user
    public CityRating submitRating(long userId, long cityId, int rating) {
        if (rating<1 || rating>5) throw new IllegalArgumentException("Rating must be between 1 and 5.");
        //find existing rating or create new
        CityRating existing = ratingRepository.findByUserIdAndCityId(userId, cityId).orElse(new CityRating(userId, cityId));
        existing.setRating(rating);
        return ratingRepository.save(existing);
    }
    /*returns avg rating of a city,0 if no ratings*/
    public double getAverageRating(long cityId) {
        List<CityRating> ratings = ratingRepository.findByCityId(cityId);
        OptionalDouble avg = ratings.stream().mapToInt(CityRating::getRating).average();
        return avg.isPresent() ? Math.round(avg.getAsDouble() * 10.0)/10.0:0.0;
    }
    /*Returns total ratings of a city*/
    public int getRatingCount(long cityId) {
        return ratingRepository.countByCityId(cityId);
    }
}
