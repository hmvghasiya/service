<!DOCTYPE html>
<html lang="en">

@include("front::layouts.head")
<body>

   @include("front::layouts.header")

    @yield("content")

    @include("front::layouts.footer")

    @include("front::layouts.javascript")
</body>

</html>