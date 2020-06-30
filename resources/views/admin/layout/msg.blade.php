<?php
// read session message
$msg = session()->get('msg');

if($msg)
    {
        $status =strtolower(substr($msg,0,2));
        if($status == "s:")
            {
                $msg_class="alert-success";
            }
        elseif ($status == "w:")
        {
            $msg_class="alert-warning";
        }
        elseif ($status == "i:")
        {
            $msg_class="alert-info";
        }
        elseif ($status == "d:")
        {
            $msg_class="alert-danger";
        }
        else
        {
            $msg_class="alert-default-";
        }
    }

?>
@if($msg)
    <div class="alert  {{$msg_class}}">
        <label>{{substr($msg,2)}}</label>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" >
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
