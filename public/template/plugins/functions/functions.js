
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

$("#search").keyup(function(e){
  var q=$(this).val()
  var div=$(".autocomplete-items");
   
    if(q!=''){
      div.css("display","block")
      $.ajax({
            url :'https://sabasboudraphp.000webhostapp.com/dsPhp/User/searchUser',
            method:'POST',
            data:{q},
            success:function(res){
                div.html(res)
            }
            
        })
    
    }else {

      div.css("display","none")
     
     
    }
 
 

});

  $(".comments").keyup(function(e){
    if(e.keyCode==13){
      
        var id_pub=$(this).data("id");
        var name=$("#fullname").text()
        var div_contenu=$(this);
        var contenu=div_contenu.val();
        var img =$(this).data("img");
        $.ajax({
            url :'https://sabasboudraphp.000webhostapp.com/dsPhp/Pub/addComment',
            method:'POST',
            data:{id_pub,contenu},
            success:function(res){
               var div=  $("<div class='card-comment'> <img class='img-circle img-sm' src='https://sabasboudraphp.000webhostapp.com/dsPhp/uploads/users/"+img+"'><div class='comment-text'> <span class='username'>"+name+"<span class='text-muted float-right'>Maintenant</span></span>"+contenu+" </div> </div>");
               $("#comment_div"+id_pub).append(div);
               div_contenu.val("")
            }
            
        })
       
       
    }
   

  });
  
  $(".delete").click(function(e){
    e.preventDefault();
      var id_commentaire=$(this).data("id")
      $.ajax({
        url :'https://sabasboudraphp.000webhostapp.com/dsPhp/Pub/deleteComment',
        method:"POST",
        data:{id_commentaire},
        success:function(res){
          $("#"+id_commentaire).remove()
        }
     })
   
   
   
 });

  

  $(".likes").click(function(e){
     e.preventDefault();
     //$(this).find("i").toggleClass("fas fa-thumbs-up mr-1, far fa-thumbs-up mr-1")
     var id_pub=$(this).attr("id");
     var span=$(this).find("span")
     $.ajax({
        url :'https://sabasboudraphp.000webhostapp.com/dsPhp/Pub/likePub',
        method:"POST",
        data:{id_pub},
        success:function(res){
          $(this).toggleClass("likes ulikes")
          span.text(parseInt(span.text())+1);
        }
     })
     
     
  });


    

  $(".send").click(function(e){
    e.preventDefault();
    var id_rec=$(this).data("idr")
    $(this).css("opacity",0.4)
    $(this).attr("disabled","disabled")
    $.ajax({
      url :'https://sabasboudraphp.000webhostapp.com/dsPhp/User/addFriend',
      method:"POST",
      data:{id_rec},
      success:function(res){
        $("#suggest"+id_rec).delay(1000).fadeOut(500);
    
      }
   })
  
  })

  $(".decisions").click(function(e){
      e.preventDefault();
      var  status=$(this).data("status")
      if(status=="1") var text="accepté"
      else text="regeté"
      var id_inv=$(this).data("id")

      $.ajax({
        url :'https://sabasboudraphp.000webhostapp.com/dsPhp/User/makeDecision',
        method:"POST",
        data:{id_inv,status},
        success:function(res){
           $(this).text(text)
        }
     })
  })
