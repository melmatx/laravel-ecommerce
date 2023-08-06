@props(['rating' => 0])

@for($star = 1; $star <= $rating; $star++)
    <x-review.rating-star :filled="true"/>
@endfor

@for($star = 1; $star <= 5 - $rating; $star++)
    <x-review.rating-star :filled="false"/>
@endfor
