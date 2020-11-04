<h3><?= $title ?></h3>
<form action="/todo/create">
    <div class="col-12">
        <?= Config\Services::validation()->listErrors(); ?>
        <div class="form-group">
            <label>Title</label>
            <input class="form-control" name="title" placeholder="Enter title" maxlength="255">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" placeholder="Enter description"></textarea>
        </div>
        <button class="btn btn-primary">Save</button>     
    </div>
</form>