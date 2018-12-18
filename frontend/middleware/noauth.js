export default function ({
    store,
    redirect
}) {
    const userIsLoggedIn = !!store.state.auth.user
    // If the user is authenticated redirect to home page
    if (userIsLoggedIn) {
        redirect('/dashboard')
    }
}