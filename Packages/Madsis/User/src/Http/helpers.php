<?php
    if (! function_exists('bouncer')) {
        function bouncer()
        {
            return app()->make(\Madsis\User\Bouncer::class);
        }
    }
?>