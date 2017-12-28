<?php

    function printA($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    function HTMListTree($tree, $prefix = '-') {
        foreach ($tree as $category) {
            if(!empty($category['children'])){
                echo '<li><a href="/category/'.$category['id'].'">'.$category['name'].'</a>';
            } else {
                echo '<li class="child"><a href="/category/'.$category['id'].'">'.$category['name'].'</a></li>';
            }
            if(!empty($category['children'])){
                echo '<ul class="parent">';
                HTMListTree($category['children'], $prefix.'-');
                echo '</ul></li>';
            }
        }
    }

    function options($tree) {
        foreach ($tree as $category) {
            echo '<option value='.$category['id'].'>'.str_repeat('&nbsp;', 4 * $category['depth']).'-- '.$category['name'].'</option>';
            options($category['children']);
        }
    }

    function commentRender($tree, $checkAuth){
        $display = $checkAuth ? 'inline' : 'none';
        foreach($tree as $comment){
            $marginLeft = 25 * $comment['depth'];
            if(!empty($comment->parent['user'])) {
                if($checkAuth){
                    echo '
                        <div class="card comment" style="margin: 0 0 15px '.$marginLeft.'px">
                            <div class="card-body" commentId="'.$comment['id'].'">
                                <h6 class="card-subtitle mb-2 text-muted" style="font-size: 12px">Comment from '.$comment['user']['name'].'</h6>
                                <p class="card-text">'.$comment->parent['user']['name'].', '.$comment['text'].'</p>
                                <a href="javascript:void(0)" class="reply" class="card-link">Reply</a>
                            </div>
                        </div>
                    ';
                } else {
                    echo '
                        <div class="card comment" style="margin: 0 0 15px '.$marginLeft.'px">
                            <div class="card-body" commentId="'.$comment['id'].'">
                                <h6 class="card-subtitle mb-2 text-muted" style="font-size: 12px">Comment from '.$comment['user']['name'].'</h6>
                                <p class="card-text">'.$comment->parent['user']['name'].', '.$comment['text'].'</p>
                            </div>
                        </div>
                    ';
                }

            } else {
                if($checkAuth) {
                    echo '
                        <div class="card comment" style="margin: 0 0 15px '.$marginLeft.'px">
                            <div class="card-body" commentId="'.$comment['id'].'">
                                <h6 class="card-subtitle mb-2 text-muted" style="font-size: 12px">Comment from '.$comment['user']['name'].'</h6>
                                <p class="card-text">'.$comment['text'].'</p>
                                <a href="javascript:void(0)" class="reply" class="card-link">Reply</a>
                            </div>
                        </div>
                    ';
                } else {
                    echo '
                        <div class="card comment" style="margin: 0 0 15px '.$marginLeft.'px">
                            <div class="card-body" commentId="'.$comment['id'].'">
                                <h6 class="card-subtitle mb-2 text-muted" style="font-size: 12px">Comment from '.$comment['user']['name'].'</h6>
                                <p class="card-text">'.$comment['text'].'</p>
                            </div>
                        </div>
                    ';
                }
            }
            commentRender($comment['children'], $checkAuth);
        }
    }

?>
