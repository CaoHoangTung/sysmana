class MessageBox{
            
    constructor(content,type){
        this.id='msgbox';
        this.content = content;
        this.bgcolor = type==="good"?"#60e760":"#ff7a7a";
        this.style = '"border-radius: 15px; opacity: 0.9; background: '+this.bgcolor
                    +'; position: fixed; right: 15px; top: 15px;'
                    +'z-index: 10; padding: 15px; color: black;'
                    +'min-width: 200px; display: none; border: 1px solid black"';
        this.interval;
    }
    move(id,pos){
        console.log("MOVE");
        if ($('#'+id)[0].style.top == "15px"){
            clearInterval();
        } else{
            pos++;
            $('#'+id)[0].style.top = pos + "px";
            setTimeout(function(){
                move(id,pos)
            },1000);
        }
    }
    show(){
        $('#'+this.id).remove();
        $('body').append("<div id='"+this.id+"' style="+this.style+">"+
                this.content+
            "</div>");
        $('#'+this.id).fadeIn(500);

        $('#'+this.id).fadeOut(10000);
    }
    hide(){
        $('#'+this.id).fadeOut(500);
    }
}
$('#msgbox').click(function(){
    $('#msgbox').fadeOut(500);
})