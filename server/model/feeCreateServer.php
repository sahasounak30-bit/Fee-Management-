<?php
// session start
session_start();

// database connection file link
include_once __DIR__ . '/../../server/config/db.php';

if ( isset( $_POST[ 'set_fee' ] ) ) {

    if (
        !empty( $_POST[ 'id' ] ) &&
        !empty( $_POST[ 'fee_amount' ] )
    ) {

        $student_id = $_POST[ 'id' ];
        $fee_amount = $_POST[ 'fee_amount' ];

        $sql = 'SELECT id FROM fee WHERE student_id = ?';
        $stmt = mysqli_prepare( $conn, $sql );
        mysqli_stmt_bind_param( $stmt, 'i', $student_id );
        mysqli_stmt_execute( $stmt );
        $result = mysqli_stmt_get_result( $stmt );
        $student = mysqli_fetch_assoc( $result );

        if ( empty( $student ) ) {

            // insert fee
            $sql = 'INSERT INTO fee (student_id,fee_amount) VALUES (?,?)';
            $stmt = mysqli_prepare( $conn, $sql );
            mysqli_stmt_bind_param( $stmt, 'id', $student_id, $fee_amount );
            mysqli_stmt_execute( $stmt );

            $_SESSION[ 'success' ][] = 'Fee added';
            header( 'Location: /feeManager/client/views/page/feePage.php' );
            exit;

        } else {

            // update fee
            $sql = 'UPDATE fee SET fee_amount=? WHERE student_id=?';
            $stmt = mysqli_prepare( $conn, $sql );
            mysqli_stmt_bind_param( $stmt, 'di', $fee_amount, $student_id );
            mysqli_stmt_execute( $stmt );

            $_SESSION[ 'success' ][] = 'Fee updated';
            header( 'Location: /feeManager/client/views/page/feePage.php' );
            exit;

        }

    } else {

        $_SESSION[ 'err' ][] = 'all fields are requerd';
        header( 'Location: /feeManager/client/views/page/feePage.php' );
        exit;

    }
}
?>