import React from 'react';

export const Layout = (props) => {

    const LayoutOptions = [
        {
            'image': '/images/offset-sidebar.svg',
            'title': 'Offset Sidebar',
            'description': 'Professional looking layout suitable for corporate positions.'
        },
        {
            'image': '/images/two-columns.svg',
            'title': '2 Columns',
            'description': 'Professional looking layout suitable for corporate positions.'
        },
        {
            'image': '/images/content-focused.svg',
            'title': 'Content Focused',
            'description': 'Professional looking layout suitable for corporate positions.'
        }
    ];

   const changeToStep = (inc) => {
        props.changeStep(inc);
    }

    const renderLayoutOptions = () => {
        return LayoutOptions.map((layout, index) => {
            return (
                <li key={index} onClick={() => { changeToStep(1) }}>
                    <img src={layout.image} />
                    <h3>{layout.title}</h3>
                    <p>{layout.description}</p>
                    <a href="#" className="btn layout-select">Start Creating</a>
                    <div className="example-option">
                        <span>or</span>
                        <a href="#">View example Resume</a>
                    </div>
                </li>
            )
        });
    }

    return (
        <div className="process">
            <div className="process--header">
                <h1>Create new Resume</h1>
                <h2>Choose a Layout</h2>
            </div>
            <div className="process--layout">
                <ul>
                    { renderLayoutOptions() }
                </ul>
            </div>
        </div>
    )
}