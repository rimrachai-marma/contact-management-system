@props(["started" => false])

<div @class(["started" => $started, "card"])>
  {{$slot}}
  <a {{$attributes}} class="btn">View Deatails</a>
</div>