import React, { Component } from 'react';
import axios from 'axios';
import { Link, Redirect } from 'react-router-dom';

import { Loading } from './UI';

import { Layout } from './Process/Layout';
import { PersonalDetails } from './Process/PersonalDetails';
import { SkillOverview } from './Process/SkillOverview';

class CV extends Component {

    constructor() {
        super();

        this.state = {
            user: window.id,
            creationStep: 0, 
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

        this.generate = this.generate.bind(this);

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
                generatePDF={this.generate}
            />,
            <SkillOverview
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

    generate(e) {
        e.preventDefault();
        let header = this.state.header;

        const _this = this;

        $.ajax({
            type: 'POST',
            url: '/cvmake',
            data: {
                header: header
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response, status, xhr) {
                // check for a filename
                var filename = "";
                var disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }

                var type = xhr.getResponseHeader('Content-Type');
                var blob = new Blob([response], { type: type });

                if (typeof window.navigator.msSaveBlob !== 'undefined') {
                    // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                    window.navigator.msSaveBlob(blob, filename);
                } else {
                    var URL = window.URL || window.webkitURL;
                    var downloadUrl = URL.createObjectURL(blob);

                    window.open(downloadUrl);

                    // _this.setState({
                    //     fileUrl: downloadUrl
                    // });

                    if (filename) {
                        // use HTML5 a[download] attribute to specify filename
                        var a = document.createElement("a");
                        // safari doesn't support this yet
                        if (typeof a.download === 'undefined') {
                            // window.location = downloadUrl;
                        } else {
                            a.href = downloadUrl;
                            a.download = filename;
                            // document.body.appendChild(a);
                            // a.click();
                        }
                    } else {
                        // window.location = downloadUrl;
                    }

                    setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
                }
            }
        })
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