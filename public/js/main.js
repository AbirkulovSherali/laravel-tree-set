$(function(){

    $(".comment .reply").on('click', function(){
        let cardBody = $(this).parent('.card-body');
        let commentId = cardBody.attr('commentId');

        if(!$(this).siblings('.replyForm').length){
            cardBody.append(`
                <form class="replyForm" method="post" style="margin-top: 15px">
                    <div class="form-group">
                        <label for="text"><b>Text:</b></label>
                        <textarea required id="text" class="form-control" name="reply[text]" rows="10"></textarea>
                        <input type='hidden' name='reply[parent_id]' value='${commentId}'>
                        <input type='hidden' name='reply[post_id]' value='${post_id}'>
                        <input type='hidden' name='reply[user_id]' value='${auth.id}'>
                        <input type='hidden' name='_token' value='${csrf_token}'>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Reply</button>
                    </div>
                </form>
            `);
        }

        if(!cardBody.children('.hide').length){
            $(this).after(`
                <a style="margin-left: 8px" href="javascript:void(0)" class="hide" class="card-link">
                    Hide
                </a>
            `);
        }

        $(".comment").on("click", ".hide", function(){
            $(this).next('.replyForm').remove();
            $(this).remove();
        })
    })

    console.log(auth);
    console.log(csrf_token);
})
