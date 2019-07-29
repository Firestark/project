<form action="/<?= $todo->id; ?>" method="POST">
    <input type="hidden" name="id" value="<?= $todo->id; ?>">
    <textarea name="description" cols="30" rows="10" placeholder="description" required><?= $todo->description; ?></textarea>
    <input type="submit">
</form>