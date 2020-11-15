
        <div clas="row">
            <<div class="col-sm-6">
                <div> class=form-group">
                    <label for="name">Titre</label>
                    <imput id="name" type="text" required class="form-control" name="name" value="
                    <?= isset ($data['name']
                    ) ? h($data['name']) : '';?>">
                    <?php if (isset($errors ['name'])): ?>
                        <p class="help-block"><?= $errors['name'];?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div> class=form-group">
                    <label for="name">Date</label>
                    <imput id="date" type="date" required class="form-control" name="date" value="<?= isset 
                    ($data['date']) ? h($data['date']) : '';?>">
                </div>
            </div>

            <div clas="row">
            <<div class="col-sm-6">
                <div> class=form-group">
                    <label for="start">Démarrage</label>
                    <imput id="start" type="time" required class="form-control" name="start" placeholder="HH:MM"
                    value="<?= isset ($data['start']) ? h($data['start']) : '';?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div> class=form-group">
                    <label for="end">Fin</label>
                    <imput id="end" type="time" required class="form-control" name="end" placeholder="HH:MM"
                    value="<?= isset ($data['end']) ? h($data['end']) : '';?>">
                </div>
            </div>
            <div class="from-group">
                <label for="description">description</label>
                <textarea name="description" id="description" class=form-control
                value="<?= isset ($data['description']) ? h($data['description']) : '';?>"></textarea>
            </div>   
