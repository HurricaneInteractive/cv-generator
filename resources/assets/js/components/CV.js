import React, { Component } from 'react';
import axios from 'axios';

import { Loading } from './UI';

class CV extends Component {

    constructor() {
        super();

        this.state = {
            user: window.user
        };
    }

    // componentDidMount() {
    //     fetch('/api/users')
    //         .then(response => {
    //             return response.json();
    //         })
    //         .then(users => {
    //             console.log(users);
    //             // this.setState({ users });
    //         });
    // }

    render() {
        
        let user = this.state.user;
        console.log(user);

        if (user === '' || user === null) {
            return <Loading />
        }

        return (
            <h1>Hello {user.name}</h1>
        );

    }
}

export default CV;