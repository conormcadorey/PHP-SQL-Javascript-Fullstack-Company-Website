<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>

    <script>
        window.cookieconsent.initialise({
        "palette": {
          "popup": {
            "background": "#343c66",
            "text": "#cfcfe8"
            },
           "button": {
          "background": "#f71559"
         }
        }
       });

       //Parallax image
        var image = document.getElementsByClassName('parallaxEffect');
            new simpleParallax(image, {
            scale: 1.2
    });
    </script>
