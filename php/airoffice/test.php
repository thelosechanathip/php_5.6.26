<!doctype html>
<html>

<head>
<script type="text/javascript" >
    //This plays a file, and call a callback once it completed (if a callback is set)

     function play(audio, callback) {
      audio.play();
      if (callback) {
        //When the audio object completes it's playback, call the callback
        //provided      
        audio.addEventListener('ended', callback);
      }
    }

    //Changed the name to better reflect the functionality
    function play_sound_queue(sounds) {
     // alert(sounds);
      var index = 0;
       function recursive_play() {
        //If the index is the last of the table, play the sound
        //without running a callback after       
        if (index  === sounds.length) { 
         
              play(sounds[index], null);
        } else {
          //Else, play the sound, and when the playing is complete
          //increment index by one and play the sound in the 
          //indexth position of the array
              play(sounds[index], function() {
             
            index++;
            recursive_play();
          });
        }
      }

      //Call the recursive_play for the first time
      recursive_play();
    }

    function play_all() {
     // alert("555");
     var arr = [new Audio("1.mp3"),new Audio("2.mp3")];
      play_sound_queue(arr);
    }

    function get_browser() {
    var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 
    if(/trident/i.test(M[1])){
        tem=/\brv[ :]+(\d+)/g.exec(ua) || []; 
        return {name:'IE',version:(tem[1]||'')};
        }   
    if(M[1]==='Chrome'){
        tem=ua.match(/\bOPR|Edge\/(\d+)/)
        if(tem!=null)   {return {name:'Opera', version:tem[1]};}
        }   
    M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
    return {
      name: M[0],
      version: M[1]
    };
 }

var browser=get_browser(); // browser.name = 'Chrome'
                           // browser.version = '40'

alert(browser);
  </script>
</head>

<body>
  <a href="#" onclick="play_all();">PLAY THIS YOU FOOL!</a>
</body>

</html>