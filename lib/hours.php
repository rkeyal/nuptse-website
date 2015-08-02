<?php
   function sum_hours($hours)
   {
      $sum = 0;
      foreach ($hours as $event)
      {
         $sum += $event["hours"];
      }
      return $sum;
   }
   ?>
