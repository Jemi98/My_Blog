<!DOCTYPE html>
<link rel = "stylesheet" href="/app.css">
<title>My Blog</title>
<body>

    <?php foreach ($posts as $post) : ?>
        

    <article>

        <h1> <?php= $post->title; ?></h1>
    </article>

    <?php endforeach ?>
 

<a href="/">Go Back</a>
</body>