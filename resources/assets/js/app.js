
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Route } from 'react-router-dom';  

import CV from './components/CV';
import Example from './components/Example';

if (document.getElementById('app-body')) {
    ReactDOM.render((
        <Router>
            <div>
                <Route path="/cv/create" component={CV} />
            </div>
        </Router>
    ), document.getElementById('app-body'));
}