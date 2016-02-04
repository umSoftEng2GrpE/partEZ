
@if (count($options))
    <html>
    <br>
    <form method="post" action="/submit_poll">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="pid" value="<?php echo $options[0]->pid ?>" id="<?php echo $options[0]->pid ?>" >
        <div class=":poll-options">
            <?php foreach($options as $index => $option): ?>
            <div class=":poll-option">
                <input type="radio" name="{!! ($index) !!}" value="{!! $option->oid !!}"    >
                <label >{!! $option->option !!}</label>
                <br>
            </div>
            <?php endforeach;?>
        </div>

        <input type="submit" value="Submit Vote">
    </form>
@else
    <p>This event has no polls.</p>
@endif

