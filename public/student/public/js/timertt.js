// time counter for quiz page


    var timeleft = 10*60;;
    var downloadTimer = setInterval(function () {
        timeleft--;
        if (timeleft >= 60) {
            var min = parseInt(timeleft / 60);
            var sec = timeleft % 60;
            document.getElementById('countdownMinuits').textContent = min;
            document.getElementById('countdownSecound').textContent = sec;
           // document.getElementById('countdownMinuits-xs').textContent = min;
           // document.getElementById('countdownSecound-xs').textContent = sec; 
        } 		 
		
		else {
            document.getElementById('countdownMinuits').textContent = 0;
            document.getElementById("countdownSecound").textContent = timeleft;
           // document.getElementById('countdownMinuits-xs').textContent = 0;
           // document.getElementById("countdownSecound-xs").textContent = timeleft;
			

	    }

        if (timeleft <= 0) {
            document.getElementById('exam-form').submit();
            clearInterval(downloadTimer);
			
        }

    }, 1000);

