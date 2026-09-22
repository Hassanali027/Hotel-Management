{{-- Desktop page title + subtitle (Figma). Hidden on phones, where each page has its own header. --}}
<div class="pg-head"><h2>{{ $pgTitle }}</h2>@if(!empty($pgSub))<p>{{ $pgSub }}</p>@endif</div>
