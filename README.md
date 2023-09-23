## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## About Test

Realizzare una piccola Web Application in Laravel 10.x da integrare con le API di Slack e ClickUp. 
L'applicazione, tramite interfaccia Web, deve permettere la creazione di un Task su ClickUp con titolo e descrizione. Il flusso atteso è il seguente:
*tramite le API di ClickUp ottenere i Workspace, le Liste e le persone di un Team, mentre con le API di Slack ottenere la lista dei canali e la relativa descrizione (se non li hai già, puoi creare Account Fake solo per l'esercizio);
*permettere all'utente la creazione del Task permettendo la selezione di Workspace, Lista, Assegnatari, Osservatori, canale Slack;
*una volta creato il Task su ClickUp deve essere inviata una notifica tramite Slack (nel canale selezionato) alle persone coinvolte;
*la notifica deve riportare il Link al Task oltre al titolo e una breve descrizione;
-questo per la parte logica mentre - per la parte di Front-End - lasciamo giudicare a te, realizzando una base come meglio tu ritenga ma con un'interfaccia che sia semplice e - a tuo modo di vedere - la più funzionale possibile.
