import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Example extends Component {
    constructor() {
        super();
        this.state = {
            user_name: 'Adriaan'
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

        $.ajax({
            type: 'POST',
            url: '/cvmake',
            data: {
                header: header
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
            }
        })
    }

    render() {
        return (
            <div>
                <h1>Cool, it's working</h1>
                <input value={this.state.user_name} onChange={(e) => {this.onChange(e)}} />
                <button onClick={this.generate}>Generate</button>
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