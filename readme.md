Google groups
=============

This plugin is based on the [google group integration documentation](https://support.google.com/groups/answer/1191206?hl=en) :

To use it in your templates, just use the `google_group` twig function like this :

    {{ google_group('your-forum-name') }}

If you want to pass options, you can pass an array like this :

    {% set options = [] %}
    {{ google_group('your-forum-name', options|merge({
        'hideforumtitle' : true,
        'hidesubject' : false,
        'showsearch' : false
        }))
    }}

Available options, and default values :

    showsearch : true
    showtabs : true
    hideforumtitle : true
    hidesubject : true
    fragments : false
    width : 700
    height : 1000