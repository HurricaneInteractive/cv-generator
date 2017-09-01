import React from 'react';

import { ProcessBack } from '../UI';

export const PersonalDetails = (props) => {

    const header = props.headerValue;
    const socials = props.socialMediaValue;

    const requiredFields = [
        {
            'key': 'name',
            'type': 'text',
            'placeholder': 'Name'
        },
        {
            'key': 'email',
            'type': 'text',
            'placeholder': 'Email Address'
        },
        {
            'key': 'phone_number',
            'type': 'number',
            'placeholder': 'Phone Number'
        },
        {
            'key': 'address',
            'type': 'text',
            'placeholder': 'Address'
        }
    ];

    const changeProcessStep = (inc) => {
        props.changeStep(inc);
    }

    const updateOnChange = (e) => {
        const value = e.target.value,
              key = e.target.name;

        props.updateInfo(key, value);
    }

    const renderFormElems = (index, key, type, placeholder) => {
        const value = header[key];
        let classAttr = '';
        let focus = '';

        index === 0 ? focus = true : focus = false;

        if (value !== '' && value !== null) {
            classAttr += 'filled-in';
        }

        return (
            <div key={key} className={`form-input ${classAttr}`}>
                <input type={type} value={value} name={key} onChange={(e) => updateOnChange(e)} autoFocus={focus} />
                <span role="placeholder" className="placeholder">{placeholder}</span>
            </div>
        );
    }

    return (
        <div className="process">
            <ProcessBack goBack={() => { changeProcessStep(-1) } } />
            <div className="process--header">
                <h1>Create new Resume</h1>
                <h2>Enter Personal Details</h2>
            </div>
            <div className="process--form process--personal-details">
                <div className="half">
                    {
                        requiredFields.map((input, index) => {
                            return renderFormElems(index, input.key, input.type, input.placeholder)
                        })
                    }
                </div>
                <div className="half">
                    { renderFormElems(1, 'personal_website', 'text', 'Personal website (optional)') }
                </div>
            </div>
        </div>
    )
}