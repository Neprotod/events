var handel = {
    target : '',

    init : function(){
        $("div.answer").on("click",function(){
            alert(2);
        });
    },
    answer : function(){
        var object = this;
        $("div.answer").on("click",function(){
            // Удаляем если такой элемент уже был создан ранее.
            $(".add_answer").remove();
            $(".redact_answer").remove();
            $(".message").removeClass("hide");

            if(object.target == $(this).get(0)){
                object.target = '';
                return;
            }
            object.target = $(this).get(0);

            var $parent = $(this).parents(".comment_box");

            var id = $parent.data("id");

            $parent.append('<div class="add_answer"><div class="form-group"><label>Ответить</label><input type="hidden" name="id" value="'+id+'" /><textarea name="message" class="form-control textarea_add" rows="3"></textarea><button type="submit" name="answer" value="1" class="btn btn-success send">Отправить</button></div></div>');
        });
    },
    answer_send : function(){
        var object = this;
        $(".form_answer").on("submit",function(){
            var $textarea = $(this).find("textarea");
            if($textarea.val() == '')
                return false;
            return true;
        });
    },
    redact : function(){
        var object = this;
        $("div.redact").on("click",function(){
            var $parent = $(this).parents(".comment_box");

            $(".add_answer").remove();
            $(".redact_answer").remove();
            $(".message").removeClass("hide");

            var message = $parent.find(".message");

            var id = $parent.data("id");
            var text = message.text();

            message.addClass("hide");

            message.after('<div class="redact_answer"><div class="form-group"><label>Ответить</label><input type="hidden" name="id" value="'+id+'" /><textarea name="message" class="form-control textarea_add" rows="3">'+text+'</textarea><button type="submit" name="edit" value="1" class="btn btn-success send">Отправить</button></div></div>');

        });
    }
}
