<h1>Todo list</h1>

<a href="/add">Add todo</a>

<ul>
    <?php foreach ($todos as $todo) : ?>
        <li>
            <a href="/<?= $todo->id; ?>"><?= $todo->description; ?></a>
            <a href="/<?= $todo->id; ?>/remove">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                <path d="M0 0h24v24H0z" fill="none"/>
            </svg>
            </a>
        </li>
    <?php endforeach; ?>
</ul>


<?php if (Session::has('message')) : ?>
    <p style="color: red;"><?= Session::get('message'); ?></p>
<?php endif; ?>