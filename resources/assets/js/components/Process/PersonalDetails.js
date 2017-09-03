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
            'type': 'text',
            'placeholder': 'Phone Number'
        },
        {
            'key': 'address',
            'type': 'text',
            'placeholder': 'Address'
        }
    ];

    const socialMedia = [
        {
            'name': 'facebook',
            'src': '/images/facebook.svg'
        },
        {
            'name': 'twitter',
            'src': '/images/twitter.svg'
        },
        {
            'name': 'linkedin',
            'src': '/images/linkedin.svg'
        },
        {
            'name': 'google_plus',
            'src': '/images/google_plus.svg'
        }
    ];

    HTMLElement.prototype.hasClass = function(target) {
        let classlist = this.classList;
        for (let i = 0; i < classlist.length; i++) {
            if (classlist[i] === target) {
                return true;
                break;
            }
        }
        return false;
    }

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

    const renderSocialMedia = (name, src) => {
        let value = socials[name];
        let classAttr = '';

        if (value !== '' && value !== null) {
            classAttr += 'linked';
        }

        return (
            <li key={name} className={`${classAttr}`} onClick={(e) => { displayPopupInput(e) }} >
                <img src={src} alt={`Social media icons - ${name}`} />
                <div className="popup-input">
                    <input 
                        type="text" 
                        name={name} 
                        value={socials[name]} 
                        onChange={(e) => { updateSocialMedia(e) }}
                        autoFocus={true}
                    />
                </div>
            </li>
        );
    }

    const displayPopupInput = (e) => {
        let target = e.target;
        
        if (target.nodeName === 'LI') {
            let popup = target.getElementsByClassName('popup-input')[0];

            if (popup.hasClass('active')) {
                popup.classList.remove('active');
            }
            else {
                let all_popups = document.getElementsByClassName('popup-input');
                for (let i = 0; i < all_popups.length; i++) {
                    all_popups[i].classList.remove('active');
                }
                popup.classList.add('active');
                popup.getElementsByTagName('input')[0].focus();
            }
        }
    }

    const updateSocialMedia = (e) => {
        const key = e.target.name,
            value = e.target.value;
        
        props.updateSocial(key, value);
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
                    <div className="process--social">
                        <h3>Social media accounts (optional)</h3>
                        <ul>
                            {
                                socialMedia.map((social, index) => {
                                    return renderSocialMedia(social.name, social.src)
                                })
                            }
                        </ul>
                        <button onClick={(e) => { props.generatePDF(e) }}>Generate</button>
                    </div>
                </div>
            </div>
        </div>
    )
}