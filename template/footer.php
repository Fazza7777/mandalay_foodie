</div>
    </section>
    <script src="<?php echo $url ?>vendor/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $url ?>vendor/bootstrap/js/poper.js"></script>
    <script src="<?php echo $url ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>   
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="<?php echo $url ?>js/app.js"></script>
    <script src="<?php echo $url ?>js/change_pass.js"></script>

<script>
  let currentPage = location.href;
  $(".menu-item-link").each(function(){
      let links =$(this).attr("href")
      if(currentPage == links){
          $(this).parent().addClass("active-item")
      }
      }
  )
</script>
</body>

</html>