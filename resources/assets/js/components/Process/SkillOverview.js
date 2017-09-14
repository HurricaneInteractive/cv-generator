import React from 'react';

import { ProcessBack, ProcessForward } from '../UI';

export const SkillOverview = (props) => {

    const changeProcessStep = (inc) => {
        props.changeStep(inc);
    }

    return (
        <div className="process">
            <ProcessBack goBack={() => { changeProcessStep(-1) } } />
            <div className="process--header">
                <h1>Create new Resume</h1>
                <h2>What are some of your skills</h2>
            </div>
            <div className="process--skills">
                <div className="instructions">
                    <p>These skills should be relevent to the job you are applying for.</p>
                </div>
                <textarea name="skills" value="" />
            </div>
            <ProcessForward goForward={() => { changeProcessStep(1) }} />
        </div>
    );
}