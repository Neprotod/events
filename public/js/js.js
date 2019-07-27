var handel = {

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

            var $parent = $(this).parents(".comment_box");

            var id = $parent.data("id");

            $parent.append('<div class="add_answer"><div class="form-group"><label>Ответить</label><input type="hidden" name="id" value="'+id+'" /><textarea name="massage" class="form-control textarea_add" rows="3"></textarea><button type="submit" class="btn btn-success send">Отправить</button></div></div>');
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
    }
}
