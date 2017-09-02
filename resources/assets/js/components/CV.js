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
            user: window.id,
            creationStep: 1,
            layout: '',
            header: {
                'name': '',
                'email': '',
                'phone_number': '',
                'address': '',
                'personal_website': ''
            },
            socialMedia: {
                'facebook': '',
                'twitter': '',
                'linkedin': '',
                'google_plus': ''
            }
        };

        this.getProcessStep = this.getProcessStep.bind(this);
        this.changeStep = this.changeStep.bind(this);
        this.chooseDocumentLayout = this.chooseDocumentLayout.bind(this);
        this.updateHeaderInformation = this.updateHeaderInformation.bind(this);
        this.updateSocialMediaInformation = this.updateSocialMediaInformation.bind(this);
    }

    getProcessStep() {
        const ProcessComponents = [
            <Layout 
                currentLayout={this.state.layout} 
                changeStep={this.changeStep} 
                chooseLayout={this.chooseDocumentLayout} 
            />,
            <PersonalDetails 
                headerValue={this.state.header}
                socialMediaValue={this.state.socialMedia}
                updateInfo={this.updateHeaderInformation} 
                updateSocial={this.updateSocialMediaInformation}
                changeStep={this.changeStep}
            />
        ];
        return ProcessComponents[this.state.creationStep];
    }

    changeStep(inc) {
        let nxtStep = this.state.creationStep + inc;
        this.setState({
            creationStep: nxtStep
        });
    }

    chooseDocumentLayout(layout) {
        this.setState({ layout: layout });
    }

    updateHeaderInformation(key, value) {
        let head = this.state.header;

        this.setState({
            header: Object.assign(
                {},
                head,
                { [key]: value }
            )
        });
    }

    updateSocialMediaInformation(key, value) {
        let socials = this.state.socialMedia;

        this.setState({
            socialMedia: Object.assign(
                {},
                socials,
                { [key]: value }
            )
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