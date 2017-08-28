import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Example extends Component {
    constructor() {
        super();
        this.state = {
            user_name: 'Adriaan',
            fileUrl: ''
        };

        this.onChange = this.onChange.bind(this);
        this.generate = this.generate.bind(this);
    }

    onChange(e) {
        this.setState({
            user_name: e.target.value
        });
    }

    generate(e) {
        e.preventDefault();
        let header = {
            'name': this.state.user_name
        }

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

                    // window.open(downloadUrl);

                    _this.setState({
                        fileUrl: downloadUrl
                    });

                    if (filename) {
                        // use HTML5 a[download] attribute to specify filename
                        var a = document.createElement("a");
                        // safari doesn't support this yet
                        if (typeof a.download === 'undefined') {
                            window.location = downloadUrl;
                        } else {
                            a.href = downloadUrl;
                            a.download = filename;
                            // document.body.appendChild(a);
                            // a.click();
                        }
                    } else {
                        window.location = downloadUrl;
                    }

                    setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
                }
            }
        })
    }

    render() {
        return (
            <div className="container">
                <h1>Resume Generation</h1>
                <input value={this.state.user_name} onChange={(e) => {this.onChange(e)}} />
                <button onClick={this.generate}>Generate</button>
                <div style={{'marginTop': '30px'}}>
                    {
                        this.state.fileUrl !== '' ? (<iframe src={this.state.fileUrl} height="500px" width="100%" />) : ('')
                    }
                </div>
            </div>
        );
    }
}

export default Example;

// We only want to try to render our component on pages that have a div with an ID
// of "example"; otherwise, we will see an error in our console 
if (document.getElementById('app-body')) {
    ReactDOM.render(<Example />, document.getElementById('app-body'));
}