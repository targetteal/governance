<div class="large-4 columns">
    &nbsp;
</div>
<div class="users form large-4 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Signup') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('organization.name', ['label' => 'Organization Name']);
            echo $this->Form->input('organization.shortname', ['label' => 'Shortname used in the URL']);
            echo $this->Form->input('organization.url', ['label' => 'Organization Website']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Signup')) ?>
    <?= $this->Form->end() ?>
</div>
<div class="large-4 columns">
    &nbsp;
</div>
<script type="text/javascript">
    $(function () {
        $('#organization-name').change(function(){
            var shortnameSuggestion = 
                $(this).val().
                toLowerCase().
                replace(/\s/g, '-').
                replace(/\W/g, '');
            $('#organization-shortname').val(shortnameSuggestion);
        });
    });
</script>