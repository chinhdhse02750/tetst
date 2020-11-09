<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@lang('emails.reset_password.subject')</title>
</head>

<body>
    @lang('emails.reset_password.content.url')<br/><br/>

    <a href="{{$url}}">{{$url}}</a><br/><br/>

    @lang('emails.reset_password.content.time_expired')<br/>
    @lang('emails.reset_password.content.text')
</body>
</html>
