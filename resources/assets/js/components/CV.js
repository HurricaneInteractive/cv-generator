import React, { Component } from 'react';
import axios from 'axios';

import { Loading } from './UI';

import { Layout } from './Process/Layout';
import { PersonalDetails } from './Process/PersonalDetails';

class CV extends Component {

    constructor() {
        super();

        this.state = {
            user: window.user,
            creationStep: 0
        };

        this.getProcessStep = this.getProcessStep.bind(this);
    }

    getProcessStep() {
        const ProcessComponents = [
            <Layout />,
            <PersonalDetails />
        ];
        return ProcessComponents[this.state.creationStep];
    }

    render() {
        let user = this.state.user;

        if (user === '' || user === null) {
            return <Loading />
        }

        return this.getProcessStep();
    }
}

export default CV;