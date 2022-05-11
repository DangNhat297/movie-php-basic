$('.ontop').click(function(){
    $('html,body').animate({scrollTop: 0});
});
function loadComment(film){
    $.ajax({
        url         : '/sitephim/module/comment.php',
        type        : 'POST',
        dataType    : 'json',
        data        : {type: 'get', film: film},
        success     : function(data){
            var count = Object.keys(data).length;
            var html = '';
            if(count > 0){
                $.each(data, function(i,value){
                    html += '<div class="comment__detail"><div class="comment__detail--name"><span>'+ value.name +'</span><span>'+ value.time +'</span></div><div class="comment__detail--content">'+ value.detail +'</div></div>';
                })
                $('.tab__comment--list').html(html);
            } else {
                $('.tab__comment--list').text('Không có bình luận');
            }
        }
    });
}
function pickEpisode(id, film){
    var regex = /(http|https|ok\.ru)/;
    $.ajax({
        url         : '/sitephim/module/getepisode.php',
        type        : 'POST',
        dataType    : 'json',
        data        : {episode: id, 'type': 'pick-episode', film: film},
        success     : function(data){
            var iframe = '';
            if(regex.test(data.player)){
                iframe = data.player;
            } else {
                iframe = "https://www.recentstatus.com/gd/?id=" + data.player;
            }
            $('#player iframe').attr("src", iframe);
        }
    });
}