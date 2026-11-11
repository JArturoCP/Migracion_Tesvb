<?php

it('returns a successful response for login', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
    $response->assertSee('Login TESVB');
});

it('redirects unauthenticated root to login', function () {
    $response = $this->get('/');

    $response->assertRedirect('/home');
});
