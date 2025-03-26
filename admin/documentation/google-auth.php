  <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 40px; }
        h1, h2, h3 { color: #2c3e50; }
        a { color: #2980b9; text-decoration: none; }
        ul { margin: 10px 0; padding-left: 20px; }
    </style>

    <h1>How to Obtain a Google OAuth Client ID and Client Secret</h1>

    <h2>Introduction</h2>
    <p>To integrate your application with Google services, you need a <strong>Google OAuth Client ID</strong> and a <strong>Client Secret</strong>. These credentials allow your app to authenticate and interact with Google's APIs securely.</p>

    <h2>Steps to Get a Google OAuth Client ID and Client Secret</h2>

    <h3>1. Go to the Google Cloud Console</h3>
    <p>Visit the <a href="https://console.developers.google.com/apis" target="_blank">Google Cloud Console</a> and sign in with your Google account.</p>

    <h3>2. Create a Project (if you don't have one)</h3>
    <ul>
        <li>Click <strong>Select a project</strong> and then <strong>New Project</strong>.</li>
        <li>Enter a project name and click <strong>Create</strong>.</li>
    </ul>

    <h3>3. Navigate to Credentials</h3>
    <ul>
        <li>Click on the <strong>Credentials</strong> section in the left-hand navigation menu.</li>
    </ul>

    <h3>4. Create Credentials</h3>
    <ul>
        <li>Click <strong>Create credentials</strong> and select <strong>OAuth client ID</strong> from the dropdown menu.</li>
    </ul>

    <h3>5. Configure OAuth Client ID</h3>
    <ul>
        <li>Choose the application type (e.g., <strong>Web application</strong>, <strong>Android</strong>, <strong>iOS</strong>).</li>
        <li>Enter a name for your OAuth 2.0 client ID.</li>
        <li>If you're creating a web application, enter the authorized JavaScript origins and redirect URIs.</li>
        <li>Click <strong>Create</strong>.</li>
    </ul>

    <h3>6. Obtain Client ID and Secret</h3>
    <ul>
        <li>The Google Cloud Console will display your <strong>Client ID</strong> and <strong>Client Secret</strong>.</li>
        <li><strong>Important:</strong> Keep the Client Secret safe and secure, as it's a sensitive piece of information.</li>
    </ul>

    <h3>7. Verify Your Business Account</h3>
    <ul>
        <li>Go to the <a href="https://console.cloud.google.com/" target="_blank">Google Cloud Console</a>.</li>
        <li>Click on <strong>IAM & Admin</strong> and then <strong>Verify Business</strong>.</li>
        <li>Provide necessary business details and documents.</li>
        <li>Google will review and approve your request.</li>
    </ul>
    <p>For more details, visit <a href="https://support.google.com/cloud/answer/9110914" target="_blank">Google Cloud Business Verification Guide</a>.</p>

    <h3>Alternative: Creating a Secret in Secret Manager</h3>
    <p>If you need to store secrets securely, you can use Google's Secret Manager service:</p>
    <ul>
        <li>Go to the <a href="https://console.cloud.google.com/security/secret-manager" target="_blank">Secret Manager</a> page in Google Cloud Console.</li>
        <li>Click <strong>Create Secret</strong>.</li>
        <li>Enter a name and the secret value, then click <strong>Create Secret</strong>.</li>
    </ul>

    <h2>Additional Resources</h2>
    <ul>
        <li><a href="https://developers.google.com/workspace/guides/create-credentials" target="_blank">Google Workspace Credentials Guide</a></li>
        <li><a href="https://cloud.google.com/secret-manager/docs/create-secret-quickstart" target="_blank">Google Secret Manager Quickstart</a></li>
        <li><a href="https://www.youtube.com/watch?v=v8j2lvjCAZc" target="_blank">Video Guide on Obtaining Google App Client ID</a></li>
    </ul>

    <h2>Conclusion</h2>
    <p>Your Google OAuth Client ID and Client Secret are crucial for authentication and secure API interactions. By following the steps above, you can successfully create, verify, and manage your credentials for safe and efficient use.</p>

