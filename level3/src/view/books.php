<section id="main" class="main-wrapper">
    <div class="container">
        <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
            <?php foreach ($data['books'] as $book): ?>
                <div data-book-id="<?php echo $book['id'] ?>"
                     class="book_item col-xs-6 col-sm-3 col-md-2 col-lg-2">
                    <div class="book">
                        <a href="/books/book/?id=<?php echo $book['id'] ?>"><img src="/assets/books-preview/<?php echo $book['preview']?>" alt="<?php echo $book['book']?>">
                            <div data-title="<?php echo $book['book']?>" class="blockI" style="height: 46px;">
                                <div data-book-title="<?php echo $book['book']?>" class="title size_text"><?php echo $book['book']?></div>
                                <div data-book-author="<?php echo $book['authors']?>" class="author"><?php echo $book['authors']?></div>
                            </div>
                        </a>
                        <a href="/books/book/?id=<?php echo $book['id'] ?>">
                            <button type="button" class="details btn btn-success">Читать</button>
                        </a>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
    <div style="display: flex; align-self: center; justify-content: center">
        <button style="display: <?php echo (count($data['books']) > DEFAULT_OFFSET) ? 'block' : 'none' ?>;
            margin-right: 20px; height: 38px; width: 80px;"
                onclick="location.href = '/?offset=<?php echo max(count($data['books']) - 10, DEFAULT_OFFSET)?>'"
                type="button" class="details btn btn-success">Назад</button>
        <button
            style="display: <?php echo (count($data['books']) < $data['totalBooks']) ? 'block' : 'none' ?>;
                margin-bottom: 20px; height: 38px; width: 80px;"
            onclick="location.href = '/?offset=<?php echo count($data['books']) + 10?>'"
            type="button" class="details btn btn-success">Вперед</button>
    </div>
</section>
