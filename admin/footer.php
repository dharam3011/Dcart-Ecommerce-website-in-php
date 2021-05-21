<!-- footer -->
</div>
<div class="d-flex justify-content-end m-3">
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-up"></i></button>
</div>
<div class="footer bg-dark text-white p-3">
    <h6 class="text-center">copyRight@2021by<?php echo WEBSITE_NAME ?>.com</h6>
    
    <ul class="mt-4 text-center">
        <li class="list-unstyled d-inline p-2"><a href="#">About</a></li>
        <li class="list-unstyled d-inline p-2"><a href="#">Pricavy</a></li>
        <li class="list-unstyled d-inline p-2"><a href="#">Term & Condition</a></li>
    </ul>
</div>

<script>
    $(document).ready(function(){
        
    // for search product dateils show more and show less
    var showChar = 100;
        var ellipsestext = "...";
        var moretext = "more";
        var lesstext = "less";

        $('.details').each(function() {
        
            var content = $(this).html();

            if(content.length > showChar) 
            {
                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);
                
                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
                
                 $(this).html(html);
                
            }
        });

        $(".morelink").click(function(){
            if($(this).hasClass("less")) 
            {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else 
            {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
        
    });

    // myorder address dropdown script
function myorderDropdown(id) {
        
        document.getElementById("myDropdown"+id).classList.toggle("show");
      }
          // Close the dropdown if the user clicks outside of it
       window.onmouseover = function(event) {
           if (!event.target.matches('.myorder-dropbtn')) {
               var dropdowns = document.getElementsByClassName("myorder-dropdown-content");
               var i;
               for (i = 0; i < dropdowns.length; i++) {
                   var openDropdown = dropdowns[i];
                   if (openDropdown.classList.contains('show')) {
                       openDropdown.classList.remove('show');
                   }
               }
           }
       }
</script>

<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

<!-- Pushy JS -->
<script src="../js/pushy.min.js"></script>

<!-- Option 1: Bootstrap Bundle with Popper -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script> -->

</body>
</html>
