<?php

    date_default_timezone_set("Europe/Paris");

    function convertDateToFormat($time){
        $time_ago=strtotime($time);
        $current_time=time();
        $time_difference=(int)$current_time-(int)$time_ago;

        $seconds=$time_difference;
        $minutes=round($seconds/60);
        $heurs=round($seconds/3600);
        $jours=round($heurs/24);
        $semaines=round($jours/7);
        $mois=round($seconds/312553280);
        $annees=round($mois/12);

        if($seconds<=60){
            return "Maintenant";
        }
        else if($minutes<=60){
            if($minutes==1){
                return "IL Y A ".$minutes." MINUTE";
            }
            else return "IL Y A ".$minutes." MINUTES";
            
        }
        else if($heurs<24){
            if($heurs==1)
               return "IL Y A ".$heurs." HEURE";
            else
               return "IL Y A ".$heurs." HEURES";
       
        }
        else if($jours<=7){
            if($jours==1) 
                return "hier";
            else 
                return "IL Y A ".$jours." jours";

        }
        else if($semaines<=4.3){
            if($semaines==1)
                return "IL YA UNE SEMAINE";
            else
                return "Il YA ".$semaines." semaines";

        }
        
        else if($mois<=12){
            if($mois==1) return "Un mois";
            else return "IL YA ".$mois." mois";
        }

        else {
            if($annees==1) return "IL YA UN AN";
            else  return $time->format("Y-m-d");
        }

    }

    function yearsBetween($time){
        $time_ago=strtotime($time);
        $current_time=time();
        $time_difference=(int)$current_time-(int)$time_ago;
        $seconds=$time_difference;
        $year=floor($seconds/31553280);
        return $year;
    }


?>