import React, { Component } from 'react';
import axios from 'axios';
import { Link, Redirect } from 'react-router-dom';

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
        this.changeStep = this.changeStep.bind(this);
    }

    getProcessStep() {
        const ProcessComponents = [
            <Layout changeStep={this.changeStep} />,
            <PersonalDetails />
        ];
        return ProcessComponents[this.state.creationStep];
    }

    changeStep(inc) {
        let nxtStep = this.state.creationStep + inc;
        this.setState({
            creationStep: nxtStep
        });
    }

    render() {
        let user = this.state.user;

        if ((user === '' || user === null) || (this.state.creationStep === null)) {
            return <Loading />
        }

        return this.getProcessStep();
    }
}

export default CV;