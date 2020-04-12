<?php
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
class w2cloud_AWS_Process extends w2cloud_Process {

    /**
     * AWS media transfer handle
     */
    public function aws_media_transfer_handle($id) {

      update_post_meta($id, 'w2cloud_sync', 'none');
      $aws_bucket = get_option('aws_bucket');
      $aws_region = get_option('aws_region');
      $aws_client_id = get_option('aws_client_id');
      $aws_client_secret = get_option('aws_client_secret');

      try {
  				$s3Client = new S3Client([
  						'version'     => 'latest',
  						'region'      => $aws_region,
  						'credentials' => [
  								'key'    => $aws_client_id,
  								'secret' => $aws_client_secret,
  						],
  				]);

  				//===Media Transfer===//
  				$file_path = get_attached_file($id);

  				$upload_directory = wp_upload_dir();
  				$base_directory = $upload_directory['basedir'].'/';
  				$data_info = wp_get_attachment_metadata( $id );
  				$file_name = str_replace($base_directory, '', $file_path);

          $filename_only = basename( get_attached_file( $id ) );
          $size_path = str_replace($filename_only, '', $file_path);
          $date_directory = str_replace($base_directory, '', $size_path);

  		    $result = $s3Client->putObject([
  		        'Bucket' => $aws_bucket,
  		        'Key' => $file_name,
  		        'SourceFile' => $file_path,
  						'ACL'    => 'public-read'
  		    ]);

  				if (isset($data_info['sizes'])) {
  	        foreach ($data_info['sizes'] as $sizedata) {
  	          $path = $size_path.$sizedata['file'];
  	          $name = $date_directory.$sizedata['file'];

  						$result = $s3Client->putObject([
  				        'Bucket' => $aws_bucket,
  				        'Key' => $name,
  				        'SourceFile' => $path,
  								'ACL'    => 'public-read'
  				    ]);
  	        }
  	      }

          if (isset($data_info['original_image'])) {
            $orig_path = $size_path.$data_info['original_image'];
            $orig_name = $date_directory.$data_info['original_image'];
            $result = $s3Client->putObject([
                'Bucket' => $aws_bucket,
                'Key' => $orig_name,
                'SourceFile' => $orig_path,
                'ACL'    => 'public-read'
            ]);
          }
  				//===Media Transfer End===//
  		} catch (S3Exception $e) {
  				return 'error';
  		}

      update_post_meta($id, 'w2cloud_sync', 'success');
      return 'success';
    }

    /**
     * AWS media delete handle
     */
    public function aws_delete_object($id) {
      $aws_bucket = get_option('aws_bucket');
      $aws_region = get_option('aws_region');
      $aws_client_id = get_option('aws_client_id');
      $aws_client_secret = get_option('aws_client_secret');

      try {

          $s3Client = new S3Client([
              'version'     => 'latest',
              'region'      => $aws_region,
              'credentials' => [
                  'key'    => $aws_client_id,
                  'secret' => $aws_client_secret,
              ],
          ]);

          $file_path = get_attached_file($id);
  				$upload_directory = wp_upload_dir();
  				$base_directory = $upload_directory['basedir'].'/';
          $data_info = wp_get_attachment_metadata( $id );
  				$file_name = str_replace($base_directory, '', $file_path);
          $filename_only = basename( get_attached_file( $id ) );
          $size_path = str_replace($filename_only, '', $file_path);
          $date_directory = str_replace($base_directory, '', $size_path);

          $s3Client->deleteObject([
              'Bucket' => $aws_bucket,
              'Key'    => $file_name
          ]);

          if (isset($data_info['sizes'])) {
            foreach ($data_info['sizes'] as $sizedata) {
              $path = $size_path.$sizedata['file'];
              $name = $date_directory.$sizedata['file'];

              $s3Client->deleteObject([
                  'Bucket' => $aws_bucket,
                  'Key'    => $name
              ]);
            }
          }

          if (isset($data_info['original_image'])) {
            $orig_path = $size_path.$data_info['original_image'];
            $orig_name = $date_directory.$data_info['original_image'];
            $s3Client->deleteObject([
                'Bucket' => $aws_bucket,
                'Key'    => $orig_name
            ]);
          }
          return true;

        } catch (S3Exception $e) {
            return false;
        }
    }

    /**
     * AWS auth checker
     */
    public function aws_auth_checker() {
      $aws_bucket = get_option('aws_bucket');
      $aws_client_id = get_option('aws_client_id');
      $aws_client_secret = get_option('aws_client_secret');
      $aws_region = get_option('aws_region');

      if (!empty($aws_bucket) && !empty($aws_client_id) && !empty($aws_client_secret) && !empty($aws_region)) {
        return(array(
            'status'=>'success',
            'message'=>'ready'
          ));
      }
      else {
        return(array(
            'status'=>'error',
            'message'=>'notready'
          ));
      }
    }

    /**
     * AWS auth data validation
     */
    public function aws_auth_form_data_validate($aws_bucket, $aws_client_id, $aws_client_secret, $aws_region, $id) {
      try {
            $s3Client = new S3Client([
                'version'     => 'latest',
                'region'      => $aws_region,
                'credentials' => [
                    'key'    => $aws_client_id,
                    'secret' => $aws_client_secret,
                ],
            ]);

            $file_path = get_attached_file($id);

    				$upload_directory = wp_upload_dir();
    				$base_directory = $upload_directory['basedir'].'/';
    				$file_name = str_replace($base_directory, '', $file_path);

            $result = $s3Client->putObject([
    		        'Bucket' => $aws_bucket,
    		        'Key' => $file_name,
    		        'SourceFile' => $file_path,
    						'ACL'    => 'public-read'
    		    ]);

            $s3Client->deleteObject([
                'Bucket' => $aws_bucket,
                'Key'    => $file_name
            ]);

            return 'success';
      } catch (S3Exception $e) {
           return $e->message;
      }
    }
}
