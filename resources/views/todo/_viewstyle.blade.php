
<div class="viewWrapper">
        <a href="/">
                <button type="button" class="btn viewtype" title="List View"><i class="fa fa-list-ul"></i> </button>
        </a>
        <a href="{{action('TodosController@gridview')}}">
                <button type="button" class="btn viewtype" title="Grid View" >
                 <i class="fa fa-th-large"></i> </button>
        </a> 
                <button type="button" class="btn viewtype" title="Grid View" id="shownoti">
                 <i class="fa fa-bell"></i></button>
    
 </div>
<div class="notis" id="notific">


</div>
 <script>
 var event2="";
 window.onload = function() { 
    $('.notis').empty();
    noti();
};
function noti(){
  $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({                       
      url: '/getreminder',
      method:'get',
      success(response){
       response=JSON.parse(response);
      if(response.length>0){
      for(var i=0;i<response.length;i++){
            var div=$("<div class='rem' id='remm'></div>");
            var ip=$('<input type="hidden" class="taskid">').val(response[i].id );
            var divv=$("<div></div>");
            var a=$('<a></a>').text(response[i].title).attr({'href':"/todo/"+response[i].taskid+"/show"});
            var div1 = $("<div></div>").css({'display':'inline-block','max-width':'70px','overflow':'hidden','text-overflow':'ellipsis','white-space':'nowrap'}).append(a);
            var span=$("<span class='delrem' id='dell'></span>").css({'float':'right','cursor':'pointer'}).text('X');
            divv.append(div1).append(span);
            var span2 =$("<span></span>").text(response[i].remdate + " " + response[i].remtime);
            div.append(ip);
            div.append(divv);
            div.append(span2);
            $(".notis").append(div);

      }
    }
    else{
           var span=$('<span></span>').text('NO REMINDERS');
           $(".notis").append(span);
    }
          }
      }); 
    
}

$('#shownoti').click(function(){
 $('.notis').toggle(); 
})
//HOVER 
 {{--  $('#shownoti').mouseenter(function(){
 $('.notis').css('display','block');
 })   


 $('#shownoti').mouseleave(function(){
 setTimeout(function () {
        if(event2="")
        $('.notis').css('display','none');
    }, 1000);

 }); 
    $('.notis').mouseenter(function(){
      event2="ready";
    $('.notis').css('display','block');
    })

    $('.notis').mouseleave(function(){
      event2="";
    $('.notis').css('display','none');
    })  --}}

  
  $('html').on('click',function(evt){
            if(evt.target.id == "notific" || evt.target.id =="shownoti" || evt.target.id =="remm" || evt.target.id =="dell")
                  return;
            if($(evt.target).closest('#notific').length)
                 return;
            if($(".notis").css('display')=='block')
                $(".notis").css('display','none');
        });  

$('body').on('click','.delrem',function(){
    var id=$(this).parents('.rem').find('.taskid').val();
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({                       
      url: '/removeremindernoti',
      method:'get',
      data:{
          id:id
      }
      });
    $(this).parents('.rem').remove();
   
})
 </script>