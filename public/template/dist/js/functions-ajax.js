$(function() {
    bsCustomFileInput.init();
  });

  function showImage() {
    if (this.files && this.files[0]) {
      var obj = new FileReader();
      obj.onload = function(data) {
        var image = document.getElementById("image");
        image.src = data.target.result;
        image.style.display = "block";
        image.style.height = "250px";
      }
      obj.readAsDataURL(this.files[0])
    }
  }

  
    $(".comments").keyup(function(e){
      if(e.keyCode==13){
        
          var id_pub=$(this).data("id");
          var div_contenu=$(this);
          var contenu=div_contenu.val();
          var img =$(this).data("img");
          $.ajax({
              url :'<?=URLROOT?>Pub/addComment',
              method:'POST',
              data:{id_pub,contenu},
              success:function(res){
                 var div=  $("<div class='card-comment'> <img class='img-circle img-sm' src='<?= URLROOT ?>/uploads/users/"+img+"'><div class='comment-text'> <span class='username'>Hamza<span class='text-muted float-right'>Maintenant</span></span>"+contenu+" </div> </div>");
                 $("#comment_div"+id_pub).append(div);
                 div_contenu.val("")
              }
              
          })
         
         
      }
     

    });

    $(".likes").click(function(e){
       e.preventDefault();
       //$(this).find("i").toggleClass("fas fa-thumbs-up mr-1, far fa-thumbs-up mr-1")
       var id_pub=$(this).attr("id");
       var span=$(this).find("span")
       $.ajax({
          url :'<?=URLROOT?>Pub/like_pub',
          method:"POST",
          data:{id_pub},
          success:function(res){
            /*
            span.text(parseInt(span.text())+1);*/
            console.log(res.status)
          }
       })
     
      
    });

    
