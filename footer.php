<div class="footer bg-dark text-white p-3">
    <center><h6>copyRight@2021byEcom.com</h6></center>
    
    <ul class="offset-4 mt-4">
        <li class="list-unstyled d-inline p-2"><a href="#">Contact Us</a></li>
        <li class="list-unstyled d-inline p-2"><a href="#">about</a></li>
        <li class="list-unstyled d-inline p-2"><a href="#">Pricavy</a></li>
        <li class="list-unstyled d-inline p-2"><a href="#">Term & Condition</a></li>
        <li class="list-unstyled d-inline p-2"><a href="admin/login_admin.php">Ecom Associate</a></li>
    </ul>
</div>

<script>
  // more and less content or details show script
    $(document).ready(function(){
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
</script>

<!-- multipal dropdown script -->
<script>
    document.addEventListener("DOMContentLoaded", function(){
// make it as accordion for smaller screens
if (window.innerWidth < 992) {

  // close all inner dropdowns when parent is closed
  document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
    everydropdown.addEventListener('hidden.bs.dropdown', function () {
      // after dropdown is hidden, then find all submenus
        this.querySelectorAll('.submenu').forEach(function(everysubmenu){
          // hide every submenu as well
          everysubmenu.style.display = 'none';
        });
    })
  });

  document.querySelectorAll('.dropdown-menu a').forEach(function(element){
    element.addEventListener('click', function (e) {
        let nextEl = this.nextElementSibling;
        if(nextEl && nextEl.classList.contains('submenu')) {	
          // prevent opening link if link needs to open dropdown
          e.preventDefault();
          if(nextEl.style.display == 'block'){
            nextEl.style.display = 'none';
          } else {
            nextEl.style.display = 'block';
          }

        }
    });
  })
}
// end if innerWidth
}); 
// DOMContentLoaded  end

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

<!-- Option 1: Bootstrap Bundle with Popper -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script> -->

<script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
</body>
</html>
