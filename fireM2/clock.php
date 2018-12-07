<script>
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: clock.php
 *
 * Date Last Modified: November 14, 2018 (Stanislav Babenko)
 *
 * Copyright: (c) 2018 by FIRE^2
 * and all corresponding participants which include:
 * Aditya Kaliappan
 * Lorenzo Neil
 * Robert Duguay
 * Stanislav Babenko
 * Daniel Volinski
 *
 * File Description:
 * This file produces the contents of the clock on the dashboard.
 */
$(document).ready(function() {
            clockUpdate();
            setInterval(clockUpdate, 1000);
          })
          
          function clockUpdate() {
            //create new Date
            var date = new Date();
              
            //check whether 0 needs to be added in front of single digit
            function addZero(x) {
              if (x < 10) {
                return x = '0' + x;
              } else {
                return x;
              }
            }
          
            //display as 12-hour time
            function twelveHour(x) {
              if (x > 12) {
                return x = x - 12;
              } else if (x === 0) {
                return x = 12;
              } else {
                return x;
              }
            }
          
            //compute the hour, minute, second
            var h = addZero(twelveHour(date.getHours()));
            var m = addZero(date.getMinutes());
            var s = addZero(date.getSeconds());
          
            //update clock contents on dashboard
            $('.digital-clock').text('EST: ' + h + ':' + m + ':' + s + ' UTC: ' + String((Number(h)+5)%24) + ':' + m + ':' + s)

          }
</script>