@props(["started" => false])

<div @class(["started" => $started, "card"])>
  {{$slot}}
  <a {{$attributes}} class="btn btn-primary">View Deatails</a>
</div>