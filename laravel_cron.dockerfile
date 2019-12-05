FROM ishaburov/laravel_php-fpm7.4

CMD while true; \
    do \
    php artisan schedule:run; \
    sleep 5; \
    done

