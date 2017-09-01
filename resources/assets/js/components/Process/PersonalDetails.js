import React from 'react';

import { ProcessBack } from '../UI';

export const PersonalDetails = (props) => {

    const changeProcessStep = (inc) => {
        props.changeStep(inc);
    }

    return (
        <div className="process">
            <ProcessBack goBack={() => { changeProcessStep(-1) } } />
            <div className="process--header">
                <h1>Create new Resume</h1>
                <h2>Enter Personal Details</h2>
            </div>
            <div className="process--layout">
                <ul>
                    
                </ul>
            </div>
        </div>
    )
}